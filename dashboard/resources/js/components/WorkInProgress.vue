<template>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">WIP</div>
            <div class="kanban">
                <div v-for="task in wipList" v-bind:key="task.id" class="kanban__item">
                    <Card
                        :id="task.id"
                        :summary="task.summary"
                        forward="done"
                        back="open"
                        @move="moveTo($event)"
                    ></Card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Card from './Card'

export default {
    components: {
        Card
    },
    props: {
        wipList: {
            type: Array,
            required: true
        }
    },
    methods: {
        moveTo: function(event) {
            this.$emit('move', {
                taskId: event.taskId,
                status: event.status
            })
        }
    }
}
</script>
