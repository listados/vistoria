var Admin = (function(){
    function domainComplet(port = null)
    {
        var project_survey = '/';
        domin  =  window.location.protocol + "//" + window.location.hostname+':'+port;
        domin + project_survey; 
        var url = window.location.origin;
        return url;
    }
    return {
        baseUrl: domainComplet
    }
}());