import {
    LOADING_DATA,
    CLEAR_ERRORS,
    SET_ERRORS,
    LOGIN_USER_SUCCESS
} from '../types';

import axios from 'axios';


/**
 * Register User
 *
 * @param newPost
 * @param history
 * @returns {function(*): void}
 */
export const registerUser = (newPost, history) => dispatch => {
    dispatch({type: LOADING_DATA});

    const config = {
        headers: { 'content-type': 'application/json' }
    }

    axios.post('/auth/register', newPost, config)
        .then(res => {
            localStorage.setItem('token', res.data.data.token);
            dispatch({type: LOGIN_USER_SUCCESS, payload: res.data.data});
            dispatch(clearErrors());
            window.location.reload(false);
        })
        .catch(err => {
            dispatch({type: SET_ERRORS, payload: err.response.data})
        })
}
/**
 * Register User
 *
 * @param newPost
 * @param history
 * @returns {function(*): void}
 */
export const loginUser = (newPost, history) => dispatch => {
    dispatch({type: LOADING_DATA});

    const config = {
        headers: { 'content-type': 'application/json' }
    }

    axios.post('/auth/login', newPost, config)
        .then(res => {
            localStorage.setItem('token', res.data.data.token);
            dispatch({type: LOGIN_USER_SUCCESS, payload: res.data.data});
            dispatch(clearErrors());
            window.location.reload(false);
        })
        .catch(err => {
            dispatch({type: SET_ERRORS, payload: err.response.data})
        })
}

export const loginUserSuccess = (token) => dispatch => {
    localStorage.setItem('token', token);
    dispatch({type: LOGIN_USER_SUCCESS, payload: {token: token}});
}

export const clearErrors = () => dispatch => {
    dispatch({ type: CLEAR_ERRORS });
}