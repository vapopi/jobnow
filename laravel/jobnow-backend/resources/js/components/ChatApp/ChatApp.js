import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import { Table, Button, NavItem } from 'react-bootstrap';
import axios from 'axios';
import User from './User'
import 'bootstrap/dist/css/bootstrap.css';
import PropTypes from 'prop-types';

function ChatApp() {

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

    //FUNCION PARA ELIMINAR EL MENSAJE
    const deleteMessage = (id) => {


        axios.delete(urlMessages + id);
        
        getMessages();
    }

    //FUNCION QUE CONTROLA EL MODO DE EDICION
    const edit = element => {

        setEditionMode(true);

        setMsg({

            message: element.message

        });

        setId(element.id);

    }

    //FUNCION PARA EDITAR UN MENSAJE
    const editMessage = e => {

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
    const createMessage = e => {

        e.preventDefault();

        if(!msg.message.trim()) {

            return;
        }

        axios.post(urlMessages, {
            
            message: msg.message,
            author_id: 1,
            receiver_id: parseInt(msg.receiver)
        
        });

        setMsg({

            message: "",
            receiver: 0

        })

        getMessages();
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
                        <h4 className='text-center'>Messages you have sended</h4>
                        {
                            <Table striped bordered hover>

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

                                        return <tr key={index}>
                                        <td>{element.id}</td>
                                        <td>{element.message}</td>
                                        <td><User id={element.receiver_id}/></td>
                                        <td><Button variant= "danger" onClick={() => deleteMessage(element.id)}>Delete Message</Button>
                                        <Button variant = "warning" onClick={() => edit(element)}>Edit Message</Button></td>
                                        </tr>

                                    })      
                                }
                                </tbody>

                            </Table>
                        }
                    </div>
                    
                    <div className="col-8" style={{margin:"0 auto"}}>
                        <h4 className="text-center">Messages you have received</h4>
                        {
                            <Table striped bordered hover>

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

                                        return <tr key={index}>
                                        <td>{element.id}</td>
                                        <td>{element.message}</td>
                                        <td><User id={element.author_id}/></td>
                                        </tr>
                                    })      
                                }
                                </tbody>
                            </Table>
                        }
                    </div>
                    
                    <div className='col-8' style={{margin:"0 auto"}}>
                        <h4 className='text-center'>
                            {
                                editionMode ? 'Edit Message' : 'Create Message'
                            }
                        </h4>
                        <form onSubmit={editionMode ? editMessage: createMessage}>
                            {
                                error ? <span className='text-danger'>{error}</span> : null
                            }
                            <div>
                                <p>To which user do you want to send the message:</p>
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
    ReactDOM.render(<ChatApp />, document.getElementById('chatapp'));
}