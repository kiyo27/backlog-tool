<template>
    <form>
        <div class="form-row align-items-center">
            <div class="col-auto my-1">
            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option v-for="option in categoryList" :key="option.id" :value="option.value">
                    {{ option.name }}
                </option>
            </select>
            </div>
            
            <div class="col-auto my-1">
            <button class="btn btn-primary" @click="refresh">Submit</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            categoryList: []
        }
    },

    mounted: function() {
        this.fetchCategories
    },

    computed: {
        fetchCategories: function() {
            axios.get('/api/categories').then(response => {
                this.categoryList = response.data
                return response.data
            })
        }
   },

   methods: {
       refresh: function(e) {
           e.preventDefault();
           console.log('refresh');
           
       }
   }
}
</script>