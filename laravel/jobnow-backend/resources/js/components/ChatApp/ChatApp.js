import React from 'react';
import ReactDOM from 'react-dom';

function ChatApp() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>

                        <div className="card-body">I'm an example component!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default ChatApp;

if (document.getElementById('chatapp')) {
    ReactDOM.render(<ChatApp />, document.getElementById('chatapp'));
}
