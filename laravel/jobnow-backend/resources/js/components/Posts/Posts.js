import React from 'react';
import ReactDOM from 'react-dom';

const Posts = () => {
  return (
    <>
      <div className='container mt-5'>
        <h1 className='text-center'>POSTS</h1>
        <hr/>
        <div className='row'>
          <div className='col-8' style={{margin: "0 auto"}}>
            
          </div>
        </div>


      </div>
    </>
  )
}

export default Posts;

if (document.getElementById('posts')) {

  ReactDOM.render(<Posts />, document.getElementById('posts'));

}