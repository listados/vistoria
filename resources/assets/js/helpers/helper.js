import api from '../services/server';
import {urlBaseApi} from "../services/server";

// Método para buscar usuários
export const getSetting = async () => {
    try {
        const response = await api.get('setting');
        return response;
    } catch (error) {
        console.error('Erro ao buscar usuários:', error);
        throw error;
    }
};

export const alterSetting = async (data) => {
    try {
        const sendData = {
            settings_aspect_general : data
        }
        const response = await api.put('setting', sendData);

    } catch (error) {
        console.error('Erro ao buscar usuários:', error);
        return error;
    }
};