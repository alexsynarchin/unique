import request from '@/utils/request';

export function fetchList(query) {
  return request({
    url: '/rewrites',
    method: 'get',
    params: query,
  });
}

export function fetchRewrite(id) {
  return request({
    url: '/rewrites/' + id,
    method: 'get',
  });
}



export function createRewrite(data) {
  return request({
    url: '/rewrite/create',
    method: 'post',
    data,
  });
}

export function updateRewrite(data) {
  return request({
    url: '/rewrite/update',
    method: 'post',
    data,
  });
}
