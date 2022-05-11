import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { Button } from 'react-bootstrap';

const Icons = ({postId, userId}) => {

  //STATES
  const [likes, setLikes] = useState([]);

  //URL de la API
  const urlLikes = '/api/likes';

  //FUNCION PARA RECUPERAR LOS LIKES DE LA BBDD
  const getLikes = async () => {

    await axios.get(urlLikes).then(result => {

      const likesBBDD = result.data;

      setLikes(likesBBDD.map((valor) => {

        return {...valor};

      }));

    });

  }

  //HACER QUE LOS LIKES SE CARGUEN UNA VEZ AL CARGAR EL COMPONENTE
  useEffect(() => {

    getLikes();

  }, []);

  const changeLike = (clicked, idLike) => {

    if(clicked) {

      axios.delete(urlLikes + idLike);

      getLikes();

    } else {

      axios.post(urlLikes, {

        user_id: userId,
        post_id: postId

      })
    }

  }

  return (
    <>
      {
        likes.map((element, index) => {

          if(element.user_id == userId && element.post_id == postId) {

            error ? <span className='text-danger'>{error}</span> : null
            
            return <div key={index}>

              <Button variant="danger" onClick={changeLike(true, element.id)}><i className="bi bi-heart-fill"></i></Button>

            </div>

          } else {

            return <div key={index}>

              <Button variant="danger" onClick={changeLike(false, element.id)}><i class="bi bi-heart"></i></Button>

            </div>
          }

        })
            
      }
    </>
  )
}

export default Icons