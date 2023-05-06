import {isEmpty} from "lodash";


export default function setupAxios(axios, store) {
    axios.interceptors.request.use(
        config => {
            const {access_token} = store.state.auth._token;
            if (access_token) {
                config.headers.Authorization = `Bearer ${access_token}`;
            }
            config.headers['Content-Type'] = 'application/json';
            config.headers['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
            return config;
        },
        err => Promise.reject(err),
    );
    axios.interceptors.response.use(
        response => {
            return response;
        },
        error => {
            if (!isEmpty(error.response)) {
                if (error.response.status === 401) {
                    store.dispatch('auth/logout');
                }
            }
            return Promise.reject(error);
        },
    );
}
