<template>
    <form>
        <div class="form-row align-items-center">
            <div class="col-auto my-1">
            <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option v-for="option in categories" :value="option.value" :key="option.id">
                    {{ option.name }}
                </option>
            </select>
            </div>
            
            <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    props: {
        categories: {
            type: Array,
            required: true,
        }
    },
   
}
</script>