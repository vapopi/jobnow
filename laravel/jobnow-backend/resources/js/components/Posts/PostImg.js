import axios from 'axios'
import React, { useEffect, useState } from 'react'

const Image = ({fileId}) => {

    const [image, setImage] = useState({});

    //FUNCION PARA COGER UN FILE EN CONCRETO DE LA BBDD
    const getImageById = async () => {

        await axios.get('/api/files/' + fileId).then(result => {

            setImage(result.data);

        });
    }

    useEffect(() => {

        getImageById();

    }, []);

  return (

    <img src={'storage/' + image.filename}></img>
  )
}

export default Image