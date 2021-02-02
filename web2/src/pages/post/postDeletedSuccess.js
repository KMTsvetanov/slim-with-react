import React, {Component} from 'react';
import { Redirect } from 'react-router-dom';

class PostDeletedSuccess extends Component {

    state = {
        redirect: false
    }

    componentDidMount() {
        this.id = setTimeout(() => this.setState({ redirect: true }), 2000)
    }

    componentWillUnmount() {
        clearTimeout(this.id)
    }

    render() {
        return this.state.redirect
            ? <Redirect to="/post" />
            : <div className="py-5">
                <div className="col-10 mx-auto text-center">
                    <h1>Post is Being Deleted!!!</h1>
                </div>
            </div>
    }
}

export default PostDeletedSuccess;