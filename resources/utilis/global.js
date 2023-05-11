import {isEmpty} from "lodash";
import axios from "axios";

/**
 * Reuse these methods in your components
 **/
export function onFieldTouch(event){
    const { name, value } = event.target;
    if(value.trim().length > 0){
        if(name !== 'email'){
            this.setFieldError(name);
        }else {
            if(!this.validEmail(value)) {
                this.setFieldError(name, 'Invalid email format')
            }else{
                this.setFieldError(name);
            }
        }
    }else {
        this.setFieldError(name, `The ${name} field is required`);
    }
}

export function setFieldError(field, errorMsg = ''){
    this.errors[field] = errorMsg;
}


export function validEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


export function validateForm(){
    const details = Object.keys(this.fields);
    let result = true;
    for (let i = 0; i < details.length; i++){
        if(isEmpty(String(this.fields[details[i]]))){
            this.setFieldError(details[i],`The field ${details[i]} is required`)
            result = false;
            break;
        }
        if(details[i] === 'email'){
            if(!this.validEmail(this.fields[details[i]])){
                this.setFieldError(details[i],'Invalid email format')
                result = false;
                break;
            }
        }
    }
    return result;
}


export function handleRequestException(response){
    if(!isEmpty(response.data.status) && response.data.status === 'error'){
        this.$toast.error(response.data.message);
    }
    const data = response.data.data;
    if(!isEmpty(data)){
        const errors = Object.values((data));
        for (let i = 0; i < errors.length; i++){
            if(Array.isArray(errors[i])){
                this.$toast.warning(errors[i][0]);
            }else {
                this.$toast.warning(errors[i]);
            }
        }
    }
}


export function selectImage() {
    this.photo.currentImage = this.$refs.file.files.item(0);
    this.photo.progress = 0;
    this.photo.message = "";
    this.uploadProfile();
};

export async function cleanUpPreviouslyUploadedImage(){
    if(/storage/i.test(this.photo.previewImage)){
        await axios.delete('/api/contact/delete-contact-image',{
            params: {
                'path': this.photo.previewImage
            }
        });
    }
}


export async function uploadProfile(){
    try {
        await this.cleanUpPreviouslyUploadedImage();
        const response = await this.processImageUpload("/api/contact/upload-profile-image",
            this.photo.currentImage, (event) => {
                this.photo.progress = Math.round((100 * event.loaded) / event.total);
            });
        const { data } = response.data;
        this.photo.previewImage = data;
        this.$toast.success('Success');
    }catch ({response}) {
        this.photo.progress = 0;
        this.photo.currentImage = undefined;
        this.photo.message = "Could not upload the image! ";
        this.handleRequestException(response);
    }
}

export async function processImageUpload(url, file, onUploadProgress) {
    let formData = new FormData();
    formData.append("file", file);
    const NewInstance = axios.create();
    return await NewInstance.post(url, formData, {
        headers: {
            Accept: 'application/json',
            Authorization: this.$store.state.auth._token,
            "Content-Type": "multipart/form-data"
        },
        onUploadProgress
    });
}

export async function fetchCategories(){
    try {
        this.processing_category_load = true;
        const response = await axios.get('/api/categories');
        const { data } = response.data;
        this.categories = data;
        this.processing_category_load = false;
    }catch ({ response }){
        this.processing_category_load = false;
        this.handleRequestException(response);
    }
}

export function initializePlacesAutoComplete(id){
    if(!id)return false;
    const autocomplete = new google.maps.places.Autocomplete(
        document.getElementById(id),
    );
    autocomplete.setComponentRestrictions({ // restrict the country
        country: ["FR","NG"]
    })
    autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace();
        const latitude = place.geometry.location.lat();
        const longitude = place.geometry.location.lng();
        this.setCoords(latitude,longitude);
        this.forceRerender();
    });
}

