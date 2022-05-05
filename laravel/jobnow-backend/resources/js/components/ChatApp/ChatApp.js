import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import {Table, Button} from 'react-bootstrap';
import axios from 'axios';
import User from './User'
import 'bootstrap/dist/css/bootstrap.css';

function ChatApp() {

    //STATES
    const [messages, setMessages] = useState([]);
    const [editionMode, setEditionMode] = useState(false);
    const [error, setError] = useState(null);
    const [message, setMessage] = useState({});
    const url = 'http://127.0.0.1/api/messages'

    const getMessages = async () => {

        await axios.get(url).then(result => {

            const mensajesBBDD = result.data;

            setMessages(mensajesBBDD.map((valor) => {

                return {...valor.data, id:valor.id}

            }));

        });
    }

    useEffect(() => {

        getMessages();

    }, []);

    const createMessage = e => {

        e.preventDefault();

        if(!message.mensaje.trim()) {

        
        }
    }

    return (
        <>
            <div className="container mt-5">
                <h1 className='text-center'>CHATAPP</h1>
                <hr/>
                <div className='row'>
                    <div className='col-8'>
                        <h4 className='text-center'>Messages List</h4>
                        {
                            messages.length === 0 ? (

                            <li className="list-group-item">Without Messages</li>

                            ) : (

                            <Table striped bordered hover>

                                <thead>

                                    <tr>

                                        <th>Id</th>
                                        <th>Mensaje</th>
                                        <th>Author</th>
                                        <th>Opciones</th>

                                    </tr>

                                </thead>

                                <tbody>
                                {
                                    messages.map((element, index) => {

                                        if (element.author_id === usuario.id) {

                                            return <tr key={index}>
                                            <td>{element.id}</td>
                                            <td>{element.message}</td>
                                            <td><User id={element.author_id}/></td>
                                            <td><Button variant = "danger" onClick={() => deleteMessagee(element.id)}>Delete Message</Button>
                                            <Button variant = "warning" onClick={() => edit(element)}>Edit Message</Button></td>
                                            </tr>
                                        }
                                    })      
                                }
                                </tbody>
                            </Table>
                        )}
                    </div>

                    <div className="col-4">
                        <h4 className="text-center">
                        {
                            editionMode ? 'Edit Message' : 'Create Message'
                        }
                        </h4>
                        <form onSubmit={editionMode ? editMessage : createMessage}>
                            {
                            error ? <span className="text-danger">{error}</span> : null
                            }

                            <input 
                            type="text"
                            name="message"
                            className="form-control mb-2"
                            placeholder="Put your message here"
                            onChange={handleInputChange}
                            // value={}
                            />

                            {
                                modoEdicion ? (
                                <button className="btn btn-dark btn-block" type="submit">Edit Message</button>
                                ) : (
                                <button className="btn btn-dark btn-block" type="submit">Create Message</button>
                                )
                            }

                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}

export default ChatApp;

if (document.getElementById('chatapp')) {
    ReactDOM.render(<ChatApp />, document.getElementById('chatapp'));
}
