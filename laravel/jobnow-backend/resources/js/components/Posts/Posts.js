import React from 'react'

const Posts = () => {
  return (
    <div>Posts</div>
  )
}

export default Posts;

if (document.getElementById('posts')) {
    ReactDOM.render(<Posts />, document.getElementById('posts'));
}