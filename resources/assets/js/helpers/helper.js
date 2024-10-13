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

export const alterSetting = async (data, type) => {
    try {
        const sendData = { }
        sendData['field'] = 'settings_' + type
        sendData['value'] = data
        return editAspectGeranal(sendData);

    } catch (error) {
        console.error('Erro ao buscar usuários:', error);
        return error;
    }
};

const editAspectGeranal = async (data) =>
{
    const response = await api.put('setting', data);
    return response;
}