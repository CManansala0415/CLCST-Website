// src/api.js
import axios from './axios' // <--- IMPORTANT: use the configured axios instance

let applicant = {}
 
const getApplicant = async (id) => {
    try {
        const results = await axios.get(`/api/get-applicant/${id}`)
        applicant = results.data
        return applicant
    } catch (err) {
        console.error('Error fetching applicant:', err)
        throw err
    }
}

let demograph = {}

const getDemograph = async (id) => {
    try {
        const results = await axios.get(`/api/get-demograph/`)
        demograph = results.data
        return demograph
    } catch (err) {
        console.error('Error fetching demograph:', err)
        throw err
    }
}

let addapplicant = {}

const addApplicant = async (data) => {
    try {
        const results = await axios.post('/api/add-applicant', data, {
            headers: {
                'Content-Type': 'application/json'
            }
        })
        addapplicant =  results.data

        return addapplicant
    } catch (err) {
        console.error('Error posting addapplicant:', err)
        throw err
    }
}



export {
    getApplicant,
    getDemograph,
    addApplicant
}


