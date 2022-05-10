import axios from 'axios';
import React, { useEffect, useState } from 'react'

const Company = ({id}) => {

    const [company, setCompany] = useState({});

    const getCompanyById = async () => {

        await axios.get('/api/companies/'+id).then(result => {

            setCompany(result.data);
        });

    }

    useEffect(() => {
        
        getCompanyById();

    }, []);

    return (
        <>
            { company.name }
        </>
    )
}

export default Company