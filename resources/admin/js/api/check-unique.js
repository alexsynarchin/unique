import request from '@/admin/js/utils/request';

export function fetchList(query) {
    return request({
        url: '/rewrites',
        method: 'get',
        params: query,
    });
}

export function fetchCheckUnique(id) {
    return request({
        url: '/rewrites/' + id,
        method: 'get',
    });
}



export function createCheckUnique(data) {
    return request({
        url: '/rewrite/create',
        method: 'post',
        data,
    });
}

export function updateCheckUnique(data) {
    return request({
        url: '/rewrite/update',
        method: 'post',
        data,
    });
}
