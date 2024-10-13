import axios from "axios";
export const urlBaseApi = process.env.MIX_BASE_API;
console.log(urlBaseApi)
export const urlBase = process.env.MIX_SENTRY_DSN_PUBLIC;

// Configuração da instância do axios
const api = axios.create({
    baseURL: urlBaseApi,
    headers: {
        'Content-Type': 'application/json',
        // Outros headers padrão podem ser adicionados aqui
    },
});

// Middleware de requisição para adicionar headers personalizados
// api.interceptors.request.use(
//     (config) => {
//         // Adicione um token de autenticação, se necessário
//         const token = localStorage.getItem('token');
//         if (token) {
//             config.headers.Authorization = `Bearer ${token}`;
//         }
//         return config;
//     },
//     (error) => {
//         return Promise.reject(error);
//     }
// );

// Middleware de resposta para tratar erros de forma global
// api.interceptors.response.use(
//     (response) => response,
//     (error) => {
//         // Trate erros comuns, como 401 (não autorizado)
//         if (error.response && error.response.status === 401) {
//             console.log("Usuário não autorizado. Faça o logout ou redirecione.");
//             // Aqui você pode redirecionar para a página de login, por exemplo.
//         }
//         return Promise.reject(error);
//     }
// );
export default api