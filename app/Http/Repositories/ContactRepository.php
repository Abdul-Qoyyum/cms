<?php
namespace App\Http\Repositories;

use App\Exports\ContactExport;
use App\Http\Constants\HttpResponseCode;
use App\Http\Resources\ContactResource;
use App\Http\Traits\PaginationHelperTrait;
use App\Http\Traits\ResponseTrait;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

class ContactRepository{
    use PaginationHelperTrait, ResponseTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function getContacts(Request $request): array
    {
        $params = $this->getPaginationParams($request);
        $contactsQuery = Contact::query()
            ->with(['user','category'])
            ->where('user_id', Auth::id());

        if($params['searchString']){
            $contactsQuery->where(function ($q) use ($params){
                $q->where('name','LIKE',"%$params[searchString]%")
                    ->orWhere('email','LIKE',"%$params[searchString]%");
            });
        }

        if($params['categoryId'] && $params['categoryId'] !== "Sort By"){
            $contactsQuery->where('category_id',$params['categoryId']);
        }

        $totalRecords = $contactsQuery->count();
        $offSet = ($params['skip'] - 1) * $params['recordsPerPage'];
        $noOfPages = ceil($totalRecords / $params['recordsPerPage']);

        $contacts = $contactsQuery
            ->orderBy($params['orderBy'], $params['direction'])
            ->skip($offSet)
            ->take($params['recordsPerPage'])
            ->get();


        return [
            'data' => ContactResource::collection($contacts),
            'noOfPages' => $noOfPages,
            'recordsPerPage' => $params['recordsPerPage'],
            'page' => $params['skip'],
            'orderBy' => $params['orderBy'],
            'direction' => $params['direction'],
            'search' => $params['searchString'],
        ];

    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    public static function createContact(Request $request): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        $request->merge(['user_id' => Auth::id()]);
        return Contact::query()->create($request->all());
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws \Exception
     */
    public static function getContact(Request $request, $id): array
    {
        $contact = Contact::query()->find($id);
        if(!$contact){
            (new self)->throwException('Contact not found', HttpResponseCode::NOT_FOUND);
        }
        return ['contact' => $contact];
    }

    public static function updateContact(Request $request, $id){
        $contact = Contact::query()->find($id);
        if(!$contact){
            (new self)->throwException('Contact not found', HttpResponseCode::NOT_FOUND);
        }
        $contact->update($request->all());
        return [ 'contact' => $contact ];
    }

    /**
     * @param Request $request
     * @return bool|string|null
     */
    public static function createContactImage(Request $request): bool|string|null
    {
        $path = null;
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/contact_profile',$filename,'local');
        }
        return Storage::disk('local')->url($path);
    }

    public static function updateContactImage(Request $request, $contact_id){
        $contact = Contact::query()->find($contact_id);
        if(!$contact){
            (new self)->throwException('Contact not found', HttpResponseCode::NOT_FOUND);
        }
        $image = self::createContactImage($request);
        $contact->update(['photo' => $image]);
        return $image;
    }
    public static function deleteContactImage(Request $request, $disk = 'local'): array
    {
        $file_path = storage_path(str_replace("/storage","app/public",$request->get('path')));
        if(file_exists($file_path)){
            unlink($file_path);
        }
        return [
            'message' => 'Image deletion successfully'
        ];
    }

    public static function deleteContact(Request $request, $id){
        $contact = Contact::query()->find($id);
        if(!$contact){
            (new self)->throwException('Contact not found', HttpResponseCode::NOT_FOUND);
        }
        $request->merge(['path' => $contact->photo]);
        $contact->delete();
        self::deleteContactImage($request);
        return [
            'status' => "success",
            'message' => 'Contact Deleted successfully'
        ];
    }

    /**
     * @param Request $request
     * @return string[]
     */
    public static function sendContactExport(Request $request): array
    {
        $user = $request->user();
        $filename = time() . 'xlsx';
        $file = Excel::download(new ContactExport($user->id), $filename, ExcelExcel::XLSX)->getFile();
        $data["email"] = $user->email;
        $data["title"] = 'Contact(s) CSV Export';
        $data["name"] = $user->name;
        Mail::send('emails.export', $data, function($message)use($data, $file, $filename) {
            $message->to($data['email'])
                ->subject($data['title'])->attach($file,[
                    'as' => $filename
            ]);
        });
        return [
            'message' => "We've sent an email to you with the exported data"
        ];
    }
}
