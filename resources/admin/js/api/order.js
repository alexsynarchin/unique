import request from '@/admin/js/utils/request';

export function fetchList(query) {
  return request({
    url: '/orders',
    method: 'get',
    params: query,
  });
}
