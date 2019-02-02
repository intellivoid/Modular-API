CREATE TABLE access_keys
(
    id INT PRIMARY KEY COMMENT 'The ID of the Access Key' AUTO_INCREMENT,
    public_id TEXT COMMENT 'The Public ID of the Access Key',
    state INT COMMENT 'The state of the access key',
    usge TEXT COMMENT 'Usage data which determines if the Access Key can still be used',
    permissions TEXT COMMENT 'Permissions data which determines what modules that this access key has access to',
    analytics TEXT COMMENT 'The Analytical data regarding the usage of this access key for this month and the past month',
    signatures TEXT COMMENT 'Encryption Signatures for authentication purposes'
);
CREATE UNIQUE INDEX access_keys_id_uindex ON api.access_keys (id);
ALTER TABLE api.access_keys COMMENT = 'The table of available access keys to use with the API';