import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import { Table, Button } from 'react-bootstrap';
import axios from 'axios';
import User from './User'
import 'bootstrap/dist/css/bootstrap.css';

function ChatApp() {

    //STATES
    const [messages, setMessages] = useState([]);

    //URL de la API
    const url = 'http://127.0.0.1:8000/api/messages';

    //FUNCION PARA RECUPERAR LOS MENSAJES DE LA BBDD
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

    return (
        <>
            <div className="container mt-5">
                <h1 className='text-center'>CHATAPP</h1>
                <hr/>
                <div className='row'>
                    <div className='col-8'>
                        <h4 className='text-center'>Messages you have sended</h4>
                        {
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

                                        return <tr key={index}>
                                        <td>{element.id}</td>
                                        <td>{element.message}</td>
                                        <td><User id={element.author_id}/></td>
                                        <td><Button variant = "danger" onClick={() => deleteMessage(element.id)}>Delete Message</Button>
                                        <Button variant = "warning" onClick={() => edit(element)}>Edit Message</Button></td>
                                        </tr>
                                    })      
                                }
                                </tbody>
                            </Table>
                        }
                    </div>

                    <div className="col-8">
                        <h4 className="text-center">Messages you have received</h4>
                        {
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

                                        return <tr key={index}>
                                        <td>{element.id}</td>
                                        <td>{element.message}</td>
                                        <td><User id={element.author_id}/></td>
                                        <td><Button variant = "danger" onClick={() => deleteMessage(element.id)}>Delete Message</Button>
                                        <Button variant = "warning" onClick={() => edit(element)}>Edit Message</Button></td>
                                        </tr>
                                    })      
                                }
                                </tbody>
                            </Table>
                        }
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
