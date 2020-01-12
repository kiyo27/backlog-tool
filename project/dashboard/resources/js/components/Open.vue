<template>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Open</div>
            <div class="kanban">
                <div v-for="task in openList" v-bind:key="task.id" class="kanban__item">
                    <Card
                        :id="task.id"
                        :summary="task.summary"
                        forward="wip"
                        back=""
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
        openList: {
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