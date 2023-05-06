const routePrefixer = (prefix, routes) => {
    for(let i = 0; i < routes.length; i++){
        if(routes[i]?.path){
            routes[i].path = routes[i].path[0] === "/" ? `/${prefix}${routes[i].path}` : `/${prefix}/${routes[i].path}`;
        }
    }
    return routes;
}

export default routePrefixer;
