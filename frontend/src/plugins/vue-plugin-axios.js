import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-plugin-axios'
// import VueAxios from '@/../../../vue-plugin-axios/src/'
import store from '@/store'
import {
    vp
} from '@/tools/helpers'
import {
    showServerError
} from '@/tools/validator'

const baseApiURL = process.env.VUE_APP_BACKEND + '/api/'; // 'http://localhost:8000/api/'

Vue.use(VueAxios, {
    axios,
    config: {
        baseURL: baseApiURL,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    },
    interceptors: {


        beforeRequest(config, axiosInstance) {
            console.log("config",config);

            if (config.baseURL === baseApiURL) {
                const token = store.state.auth.token;
                if (token) {
                    config.headers.Authorization = `Bearer ${token}`
                }

                if (config.url == "profile/current/set-avatar" || config.url == "posts") {
                    console.log("it is an image");
                    config.headers = {
                        // so laravel will understand that this is ajax $request->ajax()
                        'charset': 'utf-8',
                        'Content-Type': 'multipart/form-data',
                        'Authorization': `Bearer ${token}`
                    };

                }
            }
            return config
        },

        beforeResponseError(error) {
            const {
                response,
                message
            } = error;
            console.log("error : ",error);
            if (response) { // backend error
                // showServerError(response)
                console.log("response message : ", response)
                vp.$notify.error(message)

                // if 401
            } else if (message) { // network error

                console.log("error message : ", message)
                vp.$notify.error(message)
            }

            // return Promise.reject(error)
        }
    }
});
