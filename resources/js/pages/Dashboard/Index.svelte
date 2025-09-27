<script>
    import {Button} from "$lib/components/ui/button";
    import {Form} from "@inertiajs/svelte";
</script>

<div>
    <h1>
        Hello World
    </h1>
    <Form action="/logout" method="delete">
        <Button type="submit">Logout</Button>
    </Form>
</div>
