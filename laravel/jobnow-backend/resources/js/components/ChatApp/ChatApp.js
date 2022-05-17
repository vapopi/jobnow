import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import { Table, Button } from 'react-bootstrap';
import axios from 'axios';
import User from '../commons/User';
import 'bootstrap/dist/css/bootstrap.css';
import PropTypes from 'prop-types';

function ChatApp({props}) {

    //STATES
    const [messages, setMessages] = useState([]);
    const [editionMode, setEditionMode] = useState(false);
    const [error, setError] = useState("");
    const [msg, setMsg] = useState({});
    const [users, setUsers] = useState([]);
    const [id, setId] = useState('');

    //URL de las API
    const urlMessages = '/api/messages/';
    const urlUsers = '/api/users/';

    //FUNCION PARA RECUPERAR LOS MENSAJES DE LA BBDD
    const getMessages = async () => {

        await axios.get(urlMessages).then(result => {

            const mensajesBBDD = result.data;

            setMessages(mensajesBBDD.map((valor) => {

                return {...valor};

            }));

        });

    }

    //FUNCION PARA RECUPERAR LOS USUARIOS DE LA BBDD
    const getUsers = async () => {

        await axios.get(urlUsers).then(result => {

            const usersBBDD = result.data;

            setUsers(usersBBDD.map((valor) => {

                return {...valor};

            }));

        });
    }

    //HACER QUE LOS MENSAJES Y LOS USUARIOS SE CARGUEN UNA VEZ AL CARGAR EL COMPONENTE
    useEffect(() => {

        getMessages();
        getUsers();

    }, []);

    //FUNCION QUE CONTROLA EL MODO DE EDICION
    const edit = element => {

        setEditionMode(true);

        setMsg({

            message: element.message,
            receiver: element.receiver_id

        });

        setId(element.id);

    }

    //FUNCION PARA EDITAR UN MENSAJE
    const editMessage = (e) => {

        e.preventDefault();

        if(!msg.message.trim()) {
            
            return;
        }

        axios.put(urlMessages + id, {message: msg.message, receiver_id: parseInt(msg.receiver)});

        setEditionMode(false);

        setMsg({

            message: "",
            receiver: 0

        });

        setId('');
        setError(null);

        getMessages();
    }

    //FUNCION QUE CREA UN MENSAJE
    const createMessage = (e) => {

        e.preventDefault();

        if(!msg.message.trim()) {

            return;
        }

        axios.post(urlMessages, {
            
            message: msg.message,
            author_id: props.userid,
            receiver_id: parseInt(msg.receiver)
        
        }).then(response => {
            alert(response);

        }).catch(error => {
            alert(error.response.data);
        })

        setMsg({

            message: "",
            receiver: 0

        })
        
        setError(null);
        getMessages();
    }

    //FUNCION QUE ENSEÑA UNA ALERTA PARA CONFIRMAR LA ELIMINACION DE UN MENSAJE
    const showAlertDeleteMessage = (idMessage) => {

        let confirmDeleteMessage = confirm("Are you sure you want to delete the message with id = "+idMessage+" ?");

        if(confirmDeleteMessage) {

            axios.delete(urlMessages + idMessage);
            alert("Message deleted successfully");
            getMessages();

        }
    }

    //FUNCION QUE CONTROLA LOS ONCHANGE DEL SELECT Y DEL INPUT
    const handleInputChange = ({target}) => {

        setMsg({

            ...msg,
            [target.name]:target.value

        })
    }

    return (
        <>
            <div className="container mt-5">
                <h1 className='text-center'>CHATAPP</h1>
                <hr/>
                <div className='row'>
                    <div className='col-8' style={{margin:"0 auto"}}>
                        <h2 className='text-center'>Messages you have sended</h2>
                        {
                            <Table striped bordered hover responsive>

                                <thead>

                                    <tr>

                                        <th>Id</th>
                                        <th>Message</th>
                                        <th>Receiver</th>
                                        <th>Opciones</th>

                                    </tr>

                                </thead>

                                <tbody>
                                {
                                    messages.map((element, index) => {

                                        if(element.author_id == props.userid) {

                                            return <tr key={index}>
                                            <td>{element.id}</td>
                                            <td>{element.message}</td>
                                            <td><User id={element.receiver_id}/></td>
                                            <td><Button variant= "danger" onClick={() => showAlertDeleteMessage(element.id)}>Delete Message</Button>
                                            <Button variant = "warning" onClick={() => edit(element)}>Edit Message</Button></td>
                                            </tr>

                                        }
                                    })      
                                }
                                </tbody>

                            </Table>
                        }
                    </div>
                    
                    <div className="col-8" style={{margin:"0 auto"}}>
                        <h2 className="text-center">Messages you have received</h2>
                        {
                            <Table striped bordered hover responsive>

                                <thead>

                                    <tr>

                                        <th>Id</th>
                                        <th>Mensaje</th>
                                        <th>Author</th>

                                    </tr>

                                </thead>

                                <tbody>
                                {
                                    messages.map((element, index) => {

                                        if(element.receiver_id == props.userid) {

                                            return <tr key={index}>
                                            <td>{element.id}</td>
                                            <td>{element.message}</td>
                                            <td><User id={element.author_id}/></td>
                                            </tr>

                                        }
                                    })      
                                }
                                </tbody>
                            </Table>
                        }
                    </div>
                    
                    <div className='col-8' style={{margin:"0 auto"}}>
                        <h2 className='text-center'>
                            {
                                editionMode ? 'Edit Message' : 'Create Message'
                            }
                        </h2>
                        <form onSubmit={editionMode ? editMessage: createMessage}>
                            {
                                error ? <span className='text-danger'>{error}</span> : null
                            }
                            <div>
                                <h4>To which user do you want to send the message:</h4>
                                <select
                                name='receiver'
                                onChange={handleInputChange} key="receivers"
                                value={msg.receiver}>
                                    {
                                        <option key={0} value={0}>Select a user</option>
                                    }
                                    {
                                        users.map((element, index) => (

                                            <option key={index} value={element.id}>{element.name}</option>
                                        ))
                                    }
                                </select>
                            </div>

                            <div>
                                <input
                                    type="text"
                                    name="message"
                                    className="form-control mb-2"
                                    placeholder="Put your message here"
                                    onChange={handleInputChange}
                                    value={msg.message}
                                />

                                {
                                    editionMode ? (
                                        <button className='btn btn-dark btn-block' type='submit'>Edit Message</button>
                                    ) : (
                                        <button className='btn btn-dark btn-block' type='submit'>Create Message</button>
                                    )
                                }
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </>
    );
}

ChatApp.propTypes = {

    message : PropTypes.string,
    author_id: PropTypes.number,
    receiver_id: PropTypes.number
}

export default ChatApp;

if (document.getElementById('chatapp')) {

    const divChatapp = document.getElementById('chatapp');
    const props = Object.assign({}, divChatapp.dataset);

    ReactDOM.render(<ChatApp props = {props}/>, divChatapp);
}