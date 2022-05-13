import axios from 'axios';
import React, { useEffect, useState } from 'react'

const User = ({id}) => {

    const [user, setUser] = useState({});

    //FUNCION PARA COGER UN USUARIO EN CONCRETO DE LA BBDD
    const getUserById = async () => {

        await axios.get('/api/users/'+ id).then(result => {

            setUser(result.data);

        });

    }

    useEffect(() => {

        getUserById();

    }, []);

    return (
        <>
            { user.name }
        </>
    )
}

export default User