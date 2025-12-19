export class Fetch {
    static async userRequest(json) {
        const url = '/app/web/search';
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: json
        });
        const result = await response.json();
        console.log(result);
    }
}