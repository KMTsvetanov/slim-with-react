import React, {Component} from 'react';

import PropTypes from 'prop-types';

// Redux
import {connect} from 'react-redux';
import {registerUser} from '../../redux/actions/userActions';

// Components
import InputField from '../../components/InputField';
import {Redirect} from "react-router-dom";

class Register extends Component {
    state = {
        name: "",
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
        const {name, email, password} = this.state;
        const userData = {name, email, password};
        this.props.registerUser(userData, this.props.history);
    }

    render() {
        const {name, email, password, errors} = this.state;

        return localStorage.getItem('token') ?
            <Redirect to="/" /> : (
            <React.Fragment>
                <div className="py-5">
                    <div className="col-10 mx-auto text-center">
                        <h1 className="">Register</h1>
                    </div>
                    <div className="row">
                        <div className="col-10 mx-auto">
                            <form onSubmit={this.handleSubmit}>
                                <InputField
                                    type="text"
                                    name="name"
                                    placeholder="User Name"
                                    value={name}
                                    onChange={this.handleChange}
                                    label="Name"
                                    error={errors.name ? errors.name : ""}
                                />

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
                                    <button type="submit" className="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </React.Fragment>
        );
    }
}

Register.propTypes = {
    data: PropTypes.object.isRequired,
    registerUser: PropTypes.func.isRequired
}

const mapStateToProps = state => ({
    data: state.users
});

const mapDispatchToProps = {
    registerUser
};

export default connect(mapStateToProps, mapDispatchToProps)(Register);