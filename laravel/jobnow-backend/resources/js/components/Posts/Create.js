import axios from 'axios';
import React, { useState } from 'react';
import ReactDOM from 'react-dom';

const Create = ({props}) => {

  //STATES
  const [post, setPost] = useState({});
  const [image, setImage] = useState();

  //URL de la API
  const urlPosts = "/api/posts/";

  //FUNCION QUE GUARDA LOS CAMIOS QUE SE PRODUCEN EN LOS INPUT 
  const handleInputChange = ({target}) => {

    setPost({

      ...post,
      [target.name]:target.value

    })
  }

  //FUNCION QUE CREA UN POST EN LA BBDD
  const createPost = e => {

    e.preventDefault();

    var formData = new FormData();

    formData.append("title", post.title);
    formData.append("description", post.description);
    formData.append("image_id", image);
    formData.append("author_id", props.userid);

    axios({

      method: 'post',
      url: urlPosts,
      data: formData,
      header: {
                'Content-Type': 'multipart/form-data',
              },

    }).then(response => {

      console.log(response.data);
      alert(response.data);

    }).catch(errors => {

      alert(errors.response.data);

    });

  }

  return (
    <>
      <h1 className='text-center'><strong>POSTS</strong></h1>
      <div className='container mt-5' style={{textAlign: "center"}}>
        <a className='color btn btn-primary' href='/posts/create' role="button">Create Post</a><span> </span>
        <a className='color btn btn-primary' href='/posts' role="button">View Posts</a><span> </span>
        <hr/>
      </div>
      
      <div style={{margin:"0 auto"}} className="w-50">
        <form onSubmit={createPost}>
        
          <div className="form-group">
            <label>Title: </label>
            <input
              name="title" 
              type="text" 
              onChange={handleInputChange}
            />
          </div>

          <br/>

          <div className='form-group'>
            <label>Description: </label>
            <input
              name='description'
              type="text"
              onChange={handleInputChange}
            />
          </div>

          <br/>

          <div className='form-group'>
            <label>File: </label>
            <input 
              name="image" 
              type="file" 
              onChange={(data) => setImage(data.target.files[0])} 
              className="form-control mb-2"
            />
          </div>

          <br/>

          <button className='color btn btn-primary' type='submit'>Create Post</button>

        </form>
      </div>
    </>
  )
}

export default Create;

if(document.getElementById('posts-create')) {

  const element = document.getElementById('posts-create');
  const props = Object.assign({}, element.dataset);

  ReactDOM.render(<Create props = {props}/>, element);
}