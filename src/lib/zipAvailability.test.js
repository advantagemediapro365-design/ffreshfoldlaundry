import test from 'node:test';
import assert from 'node:assert/strict';
import { getZipAvailability } from './zipAvailability.js';

test('returns daily service for Altoona-area ZIPs', () => {
  const result = getZipAvailability('16601');
  assert.equal(result.status, 'daily');
  assert.match(result.summary, /Altoona/i);
});

test('returns weekly service for Lock Haven-area ZIPs', () => {
  const result = getZipAvailability('17745');
  assert.equal(result.status, 'weekly');
  assert.match(result.summary, /Lock Haven/i);
});

test('returns route-based service for nearby or unsupported ZIPs', () => {
  const result = getZipAvailability('16801');
  assert.equal(result.status, 'daily');
  assert.match(result.summary, /State College/i);
});

test('rejects invalid ZIP input', () => {
  const result = getZipAvailability('abc');
  assert.equal(result.status, 'invalid');
  assert.match(result.summary, /valid 5-digit ZIP code/i);
});
