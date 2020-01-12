<template>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Done</div>
            <div class="kanban">
                <div v-for="task in doneList" v-bind:key="task.id" class="kanban__item">
                    <Card
                        :id="task.id"
                        :summary="task.summary"
                        forward="closed"
                        back="wip"
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
        doneList: {
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