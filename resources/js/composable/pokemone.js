import { ref } from 'vue'

export default function usePokemon() {
    const pokemonList = ref([])
    const pokemonPagination = ref([])
    const pokemonByName = ref([])
    const pokemonByNamePagination = ref([])
    const fetchPokemon = async (page = 1) => {
        try {
            await axios(`/api/v1/pokemon?page=` + page)
                .then(response => {
                    pokemonList.value = response.data.data
                    pokemonPagination.value = response.data;
                })
        } catch (error) {
            console.error("Failed to fetch Pokemon data", error)
        }
    }
    const fetchPokemonByName = async (page = 1, searchQuery, event) => {
       if (event !== undefined) {

           let getSearchName = ''
           if (searchQuery !== undefined) {
               if (searchQuery.trim() !== '') {
                   getSearchName = searchQuery.toLowerCase()
               }
           }

           // Get the value of the search field when paginated link is click to attached to the name parameter
           const getPaginateName = document.getElementById('search-id').value

           const searchTable =  document.getElementById('search-table');
           const name = getSearchName !== '' ? getSearchName : getPaginateName;
           const tableRow = document.getElementsByTagName('tr').length
           let table = document.getElementById('list-table');

           try {
               const response = await axios.get('/api/v1/pokemon/' + name + '?page=' + page);
               if (response.data.data.length > 0) {
                   pokemonByName.value = response.data.data
                   pokemonByNamePagination.value = response.data;

                   // Hide the show all table to be able to display new table result for search
                   if (tableRow > 0 && response.data.data.length > 0) {
                       table.style.display = 'none'
                   }
                   else if (getPaginateName === undefined) {
                       table.style.display = 'display'
                   }
               }
               else {
                   table = searchTable ?? table
                   table.style.display = 'none'
                   throw new Error('No Pokemon found with that name');
               }
           } catch (error) {
               console.error('Error fetching Pokemon:', error);
           }
       }
    }

    return {
        pokemonList,
        pokemonPagination,
        pokemonByNamePagination,
        pokemonByName,
        fetchPokemon,
        fetchPokemonByName
    }
}



