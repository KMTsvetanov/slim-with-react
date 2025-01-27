import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import { BrowserRouter as Router } from 'react-router-dom';

// Redux store, and dispatch actions to the store to update data
import { Provider } from 'react-redux';
import store from './redux/store';

import {} from './redux/actions/userActions';

ReactDOM.render(
    <Provider store={store}>
        <Router>
            <App />
        </Router>
    </Provider>,
    document.getElementById('root'));
