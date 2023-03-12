const Admin = (function(){
    function domainComplet()
    {
        var project_survey = '/';
        domin  =  window.location.protocol + "//" + window.location.hostname+':';
        domin + project_survey; 
        var url = window.location.origin;
        return url;
    }
    return {
        baseUrl: domainComplet
    }
}());

export {Admin}