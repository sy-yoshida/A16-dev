export class Fetch {
    static async userRequest(json) {
        const url = '/app/web/search';
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: json
        });
        return await response.json();
    }
}
