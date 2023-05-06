import {isEmpty} from "lodash";

/**
 * Reuse these methods in your components
 **/
export function onFieldTouch(event){
    const { name, value } = event.target;
    console.log(name, value);
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
    console.log(this.errors);
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
        if(isEmpty(this.fields[details[i]])){
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
