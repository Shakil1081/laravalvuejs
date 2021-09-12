export default {
    namespaced: true,
    state: {
        lastSearch:{
        from: null,
        to:null}

      },
      mutations: {
        setLastSearch(state,payload){
            state.lastSearch = payload;
        }
      }
}


