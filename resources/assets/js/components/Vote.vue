
<template>

    <div>
        <form>
            <button @click.prevent="upvote"
                type="button" class="btn btn-default">+1</button>

            Puntuacón actual: <strong id="current-score">5</strong>

            <button @click.prevent="downvote"
            type="button" class="btn btn-default">-1</button>
        </form>
    </div>

</template>

<script>

    export default {
        methods:
        {
            upvote()
            {
                axios.post(window.location.href + '/upvote');
            },
            downvote()
            {

            }
        }
    }

</script>
