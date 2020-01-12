<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ summary }}</h5>
            <a href="#" class="card-link" @click="$emit('move', {taskId: id, status: back})" v-if="back !== ''">Move {{ back }}</a>
            <a href="#" class="card-link" @click="$emit('move', {taskId: id, status: forward})" v-if="forward !== ''">Move {{ forward }}</a>
        </div>
    </div> 
</template>

<script>
export default {
    props: [ 'id', 'summary', 'back', 'forward' ],
    
}
</script>