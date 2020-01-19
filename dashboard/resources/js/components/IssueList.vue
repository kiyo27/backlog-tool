<template>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">{{ issueStatus }}</div>
            <div class="kanban">
                <div v-for="task in issueList" v-bind:key="task.id" class="kanban__item">
                    <Card
                        :id="task.id"
                        :summary="task.summary"
                        :forward="nextStatus"
                        :back="backStatus"
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
        issueList: {
            type: Array,
            required: true
        },
        issueStatus: {
            type: String,
            required: true,
        },
        nextStatus: {
            type: String,
            required: false,
            default: ""
        },
        backStatus: {
            type: String,
            required: false,
            default: ""
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