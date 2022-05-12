import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import PropTypes from 'prop-types';
import User from '../commons/User';
import Likes from './Likes';

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

  return (
    <>
      <div style={{overflow: "auto"}}>
      {

        posts.map((element, index) => {

          return <div key={index} className="card w-50" style={{margin: "0 auto"}}>

            <div><User id={element.author_id}/></div>
            {/* INSERTAR IMG AQUI */}

            <div className='card-body'>

              <h5 className='card-title'>{element.title}</h5>
              <p className='card-text'>{element.description}</p>
              <div><Likes idPost = {element.id} idUser = {props.userid}/></div>

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