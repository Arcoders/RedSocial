
<template>

    <div>
        <form>
            <button @click.prevent="upvote"
                    :class="currentVote == 1 ? 'btn-primary' : 'btn-default'"
                    :disabled="voteInProgress"
                    type="button"
                    class="btn">
                    +1
            </button>

            Puntuacón actual: <strong id="current-score">{{ currentScore }}</strong>

            <button @click.prevent="downvote"
                    :class="currentVote == -1 ? 'btn-primary' : 'btn-default'"
                    :disabled="voteInProgress"
                    type="button"
                    class="btn">
                    -1
            </button>
        </form>
    </div>

</template>

<script>

    export default {
        props: ['score', 'vote', 'post_id'],
        data()
        {
            return {
                currentVote: this.vote ? parseInt(this.vote) : null,
                currentScore: parseInt(this.score),
                voteInProgress: false
            }
        },
        methods:
        {
            upvote()
            {
                this.addVote(1);
            },
            downvote()
            {
                this.addVote(-1);
            },
            addVote(amount)
            {
                this.voteInProgress = true;

                if (this.currentVote == amount)
                {
                    this.processRequest('delete', 'vote');

                    this.currentVote = null;
                }
                else
                {
                    this.processRequest('post', 'vote/' + amount);

                    this.currentVote = amount;
                }
            },
            processRequest(method, action)
            {
                axios[method](this.buildUrl(action)).then((res) => {
                    this.currentScore = res.data.new_score;

                    this.voteInProgress = false;
                }).catch((thrown) => {
                    alert('Error...');

                    this.voteInProgress = false;
                });
            },
            buildUrl(action)
            {
                return '/posts/' + this.post_id + '/' + action;
            }
        }
    }

</script>
