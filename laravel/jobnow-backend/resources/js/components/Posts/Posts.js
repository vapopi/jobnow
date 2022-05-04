import React from 'react';
import ReactDOM from 'react-dom';

const Posts = () => {
  return (
    <div>Posts</div>
  )
}

export default Posts;

if (document.getElementById('posts')) {
    ReactDOM.render(<Posts />, document.getElementById('posts'));
}