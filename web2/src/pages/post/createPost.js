import React, {Component} from 'react';

import PropTypes from 'prop-types';

// Redux
import {connect} from 'react-redux';
import {savePosts} from '../../redux/actions/postActions';

// Components
import InputField from '../../components/InputField';

class CreatePost extends Component {
    state = {
        title: "",
        content: "",
        image: "",
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

    fileChange = (e) => {
        let files = e.target.files;
        if(files.length) {
            this.setState({[e.target.name]: e.target.files[0]});
        }
    }

    handleSubmit = (e) => {
        e.preventDefault();

        const {title, content, image} = this.state;

        const postData = {title, content, image};

        console.log(postData);
        this.props.savePosts(postData, this.props.history);
    }

    render() {
        const {title, content, errors} = this.state;

        return localStorage.getItem('token') ? (
            <React.Fragment>
                <div className="py-5">
                    <div className="col-10 mx-auto text-center">
                        <h1 className="">Add Post</h1>
                    </div>
                    <div className="row">
                        <div className="col-10 mx-auto">
                            <form onSubmit={this.handleSubmit}>
                                <InputField
                                    type="text"
                                    name="title"
                                    placeholder="Title Name"
                                    value={title}
                                    onChange={this.handleChange}
                                    label="Title"
                                    error={errors.title ? errors.title : ""}
                                />

                                <InputField
                                    type="text"
                                    name="content"
                                    placeholder="Add Content"
                                    value={content}
                                    onChange={this.handleChange}
                                    label="Content"
                                    error={errors.content ? errors.content : ""}
                                />

                                <InputField
                                    type="file"
                                    name="image"
                                    placeholder="Image"
                                    value=""
                                    onChange={this.fileChange}
                                    label="Image"
                                    error={errors.image ? errors.image : ""}
                                />

                                <div className="form-group pt-3">
                                    <button type="submit" className="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </React.Fragment>) : (
            <div className="py-5">
                <div className="col-10 mx-auto text-center">
                    <h1 className="">Not Logged In!</h1>
                </div>
            </div>
        );
    }
}

CreatePost.propTypes = {
    data: PropTypes.object.isRequired,
    savePosts: PropTypes.func.isRequired
}

const mapStateToProps = state => ({
    data: state.posts
});

const mapDispatchToProps = {
    savePosts
};

export default connect(mapStateToProps, mapDispatchToProps)(CreatePost);