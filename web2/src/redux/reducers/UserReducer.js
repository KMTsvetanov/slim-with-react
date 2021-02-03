import {
    SET_ERRORS,
    CLEAR_ERRORS,
    LOADING_DATA,
    POST_USER, LOGIN_USER_SUCCESS
} from '../types';

const initialState = {
    user: {},
    token: {},
    errors: null,
    loading: false
}

export default function (state = initialState, action) {
    switch (action.type) {
        case SET_ERRORS:
            return {
                ...state,
                loading: false,
                errors: action.payload.message,
            };
        case POST_USER:
            return {
                ...state
            };

        case LOADING_DATA:
            return {
                ...state,
                loading: true,
            };

        case CLEAR_ERRORS:
            return {
                ...state,
                loading: false,
                errors: null
            };

        case LOGIN_USER_SUCCESS:
            return {
                ...state,
                errors: null
            };

        default:
            return state;
    }
}