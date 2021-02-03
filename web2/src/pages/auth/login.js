import React, {Component} from 'react';

import PropTypes from 'prop-types';

// Redux
import {connect} from 'react-redux';
import {loginUser} from '../../redux/actions/userActions';

// Components
import InputField from '../../components/InputField';
import {Redirect} from "react-router-dom";

class Login extends Component {
    state = {
        email: "",
        password: "",

        errors: {}
    };

    UNSAFE_componentWillReceiveProps(nextProps, nextContext) {
        if (nextProps.data.errors) {
            this.setState({
                errors: nextProps.data.errors
            })
        }
    }

    handleChange = (e) => {
        this.setState({[e.target.name]: e.target.value});
    }

    handleSubmit = (e) => {
        e.preventDefault();
        const {email, password} = this.state;
        const userData = {email, password};
        this.props.loginUser(userData, this.props.history);
    }

    render() {
        const {email, password, errors} = this.state;

        return localStorage.getItem('token') ?
            <Redirect to="/" /> : (
            <React.Fragment>
                <div className="py-5">
                    <div className="col-10 mx-auto text-center">
                        <h1 className="">Login</h1>
                    </div>
                    <div className="row">
                        <div className="col-10 mx-auto">
                            <form onSubmit={this.handleSubmit}>

                                <InputField
                                    type="text"
                                    name="email"
                                    placeholder="User Email"
                                    value={email}
                                    onChange={this.handleChange}
                                    label="Email"
                                    error={errors.email ? errors.email : ""}
                                />

                                <InputField
                                    type="password"
                                    name="password"
                                    placeholder="User Password"
                                    value={password}
                                    onChange={this.handleChange}
                                    label="Password"
                                    error={errors.password ? errors.password : ""}
                                />

                                <div className="form-group pt-3">
                                    <button type="submit" className="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </React.Fragment>
        );
    }
}

Login.propTypes = {
    data: PropTypes.object.isRequired,
    loginUser: PropTypes.func.isRequired
}

const mapStateToProps = state => ({
    data: state.users
});

const mapDispatchToProps = {
    loginUser
};

export default connect(mapStateToProps, mapDispatchToProps)(Login);