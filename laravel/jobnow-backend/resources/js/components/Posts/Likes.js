import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Button } from 'react-bootstrap'

const Likes = ({idPost, idUser}) => {

    //STATES
    const [likes, setLikes] = useState([]);
    const [clicked, setClicked] = useState(false);
    const [error, setError] = useState(null);

    //URL de las API
    const urlLikes = '/api/likes/';
    const urlPosts = '/api/posts/';

    //FUNCION QUE CARGA LOS LIKES DE LA BBDD
    const getLikes = async () => {

        await axios.get(urlLikes).then(result => {
    
          const likesBBDD = result.data;
    
          setLikes(likesBBDD.map((valor) => {
    
            return {...valor};

          }));
    
        });
    
    }

    useEffect(() => {

        getLikes();

    }, []);

    const changeLike = (idPost, idUser) => {
    
        const btLike = document.getElementById("btLike");

        if(likes.length == 0) {

            axios.post(urlLikes, {

                user_id: idUser,
                post_id: idPost

            });

            getLikes();
            setClicked(true);

        } else {

            likes.forEach(element => {

                if(element.post_id == idPost && element.user_id == idUser && clicked == false) {
    
                    btLike.variant = "danger";
                    setClicked(true);
    
                    axios.post(urlLikes, {
    
                        user_id: idUser,
                        post_id: idPost
    
                    }).then(response => {
    
                        setError(response);
                        getLikes();
                    });
    
                    axios.get(urlPosts + element.post_id).then(result => {
    
                        const post = result.data;
                        var likes = post.likes;
    
                        axios.put(urlPosts + element.post_id, {likes: likes + 1});
    
                    });
    
                } else if(element.post_id == idPost && element.user_id == idUser && clicked == true) {
    
                    btLike.variant = "primary";
                    setClicked(false);
    
                    axios.delete(urlLikes + element.id);
                }
            })
        }
        
    }

  return (
    <>
    {
        error ? <span className='text-success'>{error}</span> : null
    }
        <Button variant="primary" id="btLike" onClick={() => changeLike(idPost, idUser)}><i className="bi bi-hand-thumbs-up-fill"></i></Button>
    </>
  )
}

export default Likes