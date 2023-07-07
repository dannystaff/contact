import axios from 'axios';

/**
 * Axios GET request
 * @param endpoint 
 * @param parameters 
 */
export async function get(endpoint: string, parameters: object) {
    return axios.get(endpoint, {
            params: parameters
        })
        .then((res) => res)
        .catch((error) => error.response);
}

/**
 * Axios POST request
 * @param endpoint 
 * @param parameters 
 */
export async function post(endpoint: string, parameters: object) {
    return axios.post(endpoint, parameters)
        .then((res) => res)
        .catch((error) => error.response);
}