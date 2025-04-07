function useTable(url, { columns, data, contaner }) {
    return new gridjs.Grid({
        columns: columns,
        resizable: true,
        server: {
            url: url,
            then: (x) => x.data.map(data),
            total: (response) => response.total,
        },
        pagination: {
            enabled: true,
            limit: 10,
            server: {
                url: (prev, page, limit) =>
                    `${prev}?page=${page + 1}&limit=${limit}`,
            },
        },
    }).render(document.getElementById(contaner));
}
