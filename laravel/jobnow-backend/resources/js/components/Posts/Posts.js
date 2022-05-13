import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import User from '../commons/User';
import Likes from './Likes';
import PostImg from './PostImg';

const Posts = ({props}) => {

  //STATES
  const [posts, setPosts] = useState([]);

  //URL de las API
  const urlPosts = '/api/posts/';

  //FUNCION PARA RECUPERAR LOS POSTS DE LA BBDD
  const getPosts = async () => {

    await axios.get(urlPosts).then(result => {

      const postsBBDD = result.data;

      setPosts(postsBBDD.map((valor) => {

        return {...valor};

      }));

    });

  }

  //HACER QUE LOS POSTS SE CARGUEN UNA VEZ AL CARGAR EL COMPONENTE
  useEffect(() => {

    getPosts();

  }, []);

  const showAlertDeletePost = (idPost) => {

    let confirmDeletePost = confirm("Are you sure you want to delete the post with id = "+idPost+" ?");

    if(confirmDeletePost) {

        axios.delete(urlPosts + idPost);
        alert("Post deleted successfully");
        getPosts();

    }

  }

  return (
    <>
      <div style={{overflow: "auto"}}>
        <h1 className='text-center'><strong>POSTS</strong></h1>
        <div className='container mt-5' style={{textAlign: 'center'}}>
          <a className='color btn btn-primary' href='/posts/create' role="button">Create Post</a><span> </span>
          <a className='color btn btn-primary' href='/posts' role="button">View Posts</a><span> </span>
          <hr/>
        </div>
        
      {

        posts.map((element, index) => {

          return <div key={index} className="card w-50" style={{margin: "0 auto"}}>

            <h5><p>Post created by: <User id={element.author_id}/></p></h5>
            {/* INSERTAR IMG AQUI */}
            <PostImg fileId = {element.image_id}/>

            <div className='card-body'>

              <h5 className='card-title'>{element.title}</h5>
              <p className='card-text'>{element.description}</p>
              <div><Likes idPost = {element.id} idUser = {props.userid}/>
              
              {
                element.author_id == props.userid ? (

                  <button className='color btn btn-primary' onClick={() => showAlertDeletePost(element.id)}>Delete Post</button>

                ) : (
                  
                  <span></span>
                )
              }
              
              </div>

            </div>

          </div>

        })
      }

      </div>
    </>
  )
}

export default Posts;

if (document.getElementById('posts')) {

  const divPosts = document.getElementById('posts');
  const props = Object.assign({}, divPosts.dataset);

  ReactDOM.render(<Posts props = {props}/>, divPosts);
}