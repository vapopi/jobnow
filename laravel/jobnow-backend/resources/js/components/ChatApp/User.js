import axios from 'axios';
import React, { useEffect, useState } from 'react'

const User = ({id}) => {

    const [user, setUser] = useState({});

    //FUNCION PARA COGER TODOS LOS USUARIOS DE LA BBDD
    const getUserById = async () => {

        await axios.get('http://127.0.0.1:8000/api/users/'+ id).then(result => {

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