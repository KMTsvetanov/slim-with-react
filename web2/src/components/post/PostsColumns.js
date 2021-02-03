import React, {Component} from 'react';

class PostsColumns extends Component {
    render() {
        return (
            <div className="container">
                <div className="row post-row">
                    <div className="col-2 py-3 grid-color-primary">Title</div>
                    <div className="col-6 py-3 grid-color-secondary">Content</div>
                    <div className="col-2 py-3 grid-color-primary">Image</div>
                    {localStorage.getItem('token') ? (
                        <div className="col-2 py-3 grid-color-secondary"></div>
                    ) : null}
                </div>
            </div>
        );
    }
}

export default PostsColumns;